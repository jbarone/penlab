Web Application Pentesting Lab
==============================

A default LAMP development stack configuration for Vagrant. That includes a vulnerable web application.

Installation:
-------------

Download and install [VirtualBox](http://www.virtualbox.org/)

Download and install [vagrant](http://vagrantup.com/)

Download a vagrant box (name of the box is supposed to be precise32)

    $ vagrant box add precise32 http://files.vagrantup.com/precise32.box

Clone this repository

Go to the repository folder and launch the box

    $ cd [repo]
    $ vagrant up

Add the following lines to your hosts file:

    192.168.33.11       penlab.geocent.com
    192.168.33.11       penlab2.geocent.com

Your host file can be found at `C:\Windows\System32\drivers\etc\hosts` on windows or `/etc/hosts` on Mac OS X and Linux.

Updating:
---------

If you've already setup your vagrant box for penlab 1 then simply run 

	vagrant provision

This will refresh the environment and add the penlab 2.

Using The Lab:
--------------

Once the virtual machine is up and running, you can simply access the lab site by opening a browser and going to:
- [http://penlab.geocent.com](http://penlab.geocent.com)
- [http://penlab2.geocent.com](http://penlab2.geocent.com)
