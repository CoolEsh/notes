VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "notes"
  #config.vm.box_url = "/home/coolesh/PhpstormProjects/notes/notes.box"
  external_ports = {http: 80, https: 443}

  if RbConfig::CONFIG['target_os'] =~ /linux|darwin/i
    external_ports[:http] = 8080
    external_ports[:https] = 8443
  end

  config.vm.network :forwarded_port, guest: 80, host: external_ports[:http]
  config.vm.network :forwarded_port, guest: 443, host: external_ports[:https]

  config.vm.network :forwarded_port, guest: 3306, host: 3307

  config.vm.synced_folder "./", "/home/andrew/webapp", owner: "andrew", group: "www-data"
end