Tudlo Hrm
===========

Tudlo Hrm is a HRM software which enable companies of all sizes to manage HR activities
properly. 

Installation
------------
 * Download the latest release https://github.com/tudlo/hrm/releases/latest

 * Copy the downloaded file to the path you want to install Tudlo Hrm in your server and extract.

 * Create a mysql DB for and user. Grant all on iCE Hrm DB to new DB user.

 * Visit iCE Hrm installation path in your browser.

 * During the installation form, fill in details appropriately.

 * Once the application is installed use the username = admin and password = admin to login to your system.

 Note: Please rename or delete the install folder (<hrm root>/app/install) since it could pose a security threat to your Hrm instance.

Manual Installation
-------------------

[](https://thilinah.gitbooks.io/icehrm-guide/content/manual-installation.html)

Setup Tudlo HRM Development Environment
------------------------------------

Tudlo HRM development environment is packaged as a Vagrant box. I includes php7, nginx, phpunit and other
software required for running Tudlo HRM

Preparing development VM with Vagrant
-------------------------------------

- Clone Tudlo hrm from https://github.com/tudlo/hrm.git or download the source

- Install Vagrant [https://www.vagrantup.com/downloads.html](https://www.vagrantup.com/downloads.html)

- Install Vagrant host updater plugin [https://github.com/cogitatio/vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater)

- Run vagrant up in hrm root directory (this will download Tudlo HRM vagrant image which is  ~1 GB)

```
~ $ vagrant up
```

- Run vagrant ssh to login to the Virtual machine

```
~ $ vagrant ssh
```

- Install ant build in your VM

```
~ $ sudo apt-get install ant
```

- Build hrm (your hrm root directory is mapped to /vagrant/ directory in VM)

```
~ $ cd /vagrant
~ $ ant buildlocal
```

- Execute table creation scripts
```
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrmdb.sql
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrm_master_data.sql
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrm_sample_data.sql
```

- Navigate to [http://clients.app.dev/dev](http://clients.app.dev/dev) to load Tudlo HRM from VM. (user:admin/pass:admin)

- Unit testing

```
~ $ cd /vagrant
~ $ phpunit
```


