# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
   config.vm.box = "centos/7"
   config.vm.provision "shell", path: "vagrant/provision.sh"

   config.vm.synced_folder ".", "/vagrant"

   config.vm.provider "virtualbox" do |v|
     v.memory = 1024
   end
end
