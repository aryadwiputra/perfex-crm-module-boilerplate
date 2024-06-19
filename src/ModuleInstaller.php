<?php

namespace Arya\PerfexCRMModuleBoilerplate;

use Composer\Script\Event;

class ModuleInstaller
{
  public static function postPackageInstall(Event $event)
  {
    $composer = $event->getComposer();
    $package = $event->getOperation()->getPackage();
    $extra = $composer->getPackage()->getExtra();

    if (!isset($extra['installer-paths'])) {
      return;
    }

    $installPaths = $extra['installer-paths'];
    foreach ($installPaths as $path => $types) {
      if (in_array("type:perfex-crm-module", $types)) {
        $moduleName = $package->getName();
        $modulePath = str_replace('{$name}', $moduleName, $path);

        if (!is_dir($modulePath)) {
          mkdir($modulePath, 0755, true);
        }

        file_put_contents($modulePath . '/module.php', "<?php\n\n// $moduleName module");
        echo "Module $moduleName has been installed to $modulePath\n";
      }
    }
  }
}
