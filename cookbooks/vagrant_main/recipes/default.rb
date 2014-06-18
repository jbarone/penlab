include_recipe "apt"
include_recipe "build-essential"
include_recipe "git"
include_recipe "apache2"
include_recipe "apache2::mod_rewrite"
include_recipe "apache2::mod_ssl"
include_recipe "mysql::server"
include_recipe "php"
include_recipe "php::module_mysql"
include_recipe "php::module_apc"
include_recipe "php::module_curl"
include_recipe "apache2::mod_php5"

# Install packages
%w{ debconf vim screen tmux mc subversion curl make g++ libsqlite3-dev graphviz libxml2-utils lynx links whois}.each do |a_package|
  package a_package
end

# Install ruby gems
%w{ rdoc rake mailcatcher }.each do |a_gem|
  gem_package a_gem
end

# Generate selfsigned ssl
execute "make-ssl-cert" do
  command "make-ssl-cert generate-default-snakeoil --force-overwrite"
  ignore_failure true
  action :nothing
end

# Initialize sites data bag
sites = []
begin
  sites = data_bag("sites")
rescue
  puts "Unable to load sites data bag."
end

# Configure sites
sites.each do |name|
  site = data_bag_item("sites", name)

  # Add site to apache config
  web_app site["host"] do
    template "sites.conf.erb"
    server_name site["host"]
    server_aliases site["aliases"]
    server_include site["include"]
    docroot site["docroot"]?site["docroot"]:"/vagrant/public/#{site["host"]}"
  end

   # Add site info in /etc/hosts
   bash "hosts" do
     code "echo 127.0.0.1 #{site["host"]} #{site["aliases"].join(' ')} >> /etc/hosts"
     code "mysql --user=root --password=#{node["mysql"]["server_root_password"]} < /vagrant/databases/#{site["database"]}/setup.sql"
   end
end

# Disable default site
apache_site "default" do
  enable false
end

# Install phpmyadmin
cookbook_file "/tmp/phpmyadmin.deb.conf" do
  source "phpmyadmin.deb.conf"
end
bash "debconf_for_phpmyadmin" do
  code "debconf-set-selections /tmp/phpmyadmin.deb.conf"
end
package "phpmyadmin"

# Install php-xsl
package "php5-xsl" do
  action :install
end

# Setup MailCatcher
bash "mailcatcher" do
  code "mailcatcher --http-ip 0.0.0.0 --smtp-port 25"
  not_if "ps ax | grep -v grep | grep mailcatcher";
end
template "#{node['php']['ext_conf_dir']}/mailcatcher.ini" do
  source "mailcatcher.ini.erb"
  owner "root"
  group "root"
  mode "0644"
  action :create
  notifies :restart, resources("service[apache2]"), :delayed
end
cookbook_file "/etc/rc.local" do
  source "rc.local"
  owner "root"
  group "root"
  mode "0755"
  action :create
end

# Fixing deprecated php comments style in ini files
bash "deploy" do
  code "sudo perl -pi -e 's/(\s*)#/$1;/' /etc/php5/cli/conf.d/*ini"
  notifies :restart, resources("service[apache2]"), :delayed
end
