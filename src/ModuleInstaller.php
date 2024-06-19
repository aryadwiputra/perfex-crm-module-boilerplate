<?php

namespace YourVendor\PerfexCRMModuleBoilerplate;

use Composer\Script\Event;
use Composer\IO\ConsoleIO;

class ModuleInstaller
{
  public static function postPackageInstall(Event $event)
  {
    $io = $event->getIO();

    $moduleName = $io->ask('Please enter the module name: ');

    if (!$moduleName) {
      $io->writeError('Module name cannot be empty');
      return;
    }

    $modulePath = 'modules/' . $moduleName;

    if (!is_dir($modulePath)) {
      mkdir($modulePath, 0755, true);
    }

    file_put_contents($modulePath . '/module.php', "<?php\n\n// $moduleName module");
    $io->write("Module $moduleName has been installed to $modulePath");
  }
}
