<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'App\\Config\\App' => $baseDir . '/app/Config/App.php',
    'App\\Config\\Cache' => $baseDir . '/app/Config/Cache.php',
    'App\\Console\\CommandInterface' => $baseDir . '/app/Console/CommandInterface.php',
    'App\\Console\\CommandRunner' => $baseDir . '/app/Console/CommandRunner.php',
    'App\\Console\\Commands\\CreateController' => $baseDir . '/app/Console/Commands/CreateController.php',
    'App\\Console\\Commands\\CreateMigration' => $baseDir . '/app/Console/Commands/CreateMigration.php',
    'App\\Console\\Commands\\CreateModel' => $baseDir . '/app/Console/Commands/CreateModel.php',
    'App\\Console\\Commands\\CreateSeeder' => $baseDir . '/app/Console/Commands/CreateSeeder.php',
    'App\\Controllers\\BaseController' => $baseDir . '/app/Controllers/BaseController.php',
    'App\\Controllers\\EmailTestController' => $baseDir . '/app/Controllers/EmailTestController.php',
    'App\\Controllers\\HomeController' => $baseDir . '/app/Controllers/HomeController.php',
    'App\\Controllers\\UserController' => $baseDir . '/app/Controllers/UserController.php',
    'App\\Core\\Cache' => $baseDir . '/app/Core/Cache.php',
    'App\\Core\\Controller' => $baseDir . '/app/Core/Controller.php',
    'App\\Core\\Database' => $baseDir . '/app/Core/Database.php',
    'App\\Core\\EmailService' => $baseDir . '/app/Core/EmailService.php',
    'App\\Core\\Env' => $baseDir . '/app/Core/Env.php',
    'App\\Core\\Migration' => $baseDir . '/app/Core/Migration.php',
    'App\\Core\\Model' => $baseDir . '/app/Core/Model.php',
    'App\\Core\\Router' => $baseDir . '/app/Core/Router.php',
    'App\\Core\\Security' => $baseDir . '/app/Core/Security.php',
    'App\\Core\\View' => $baseDir . '/app/Core/View.php',
    'App\\Models\\UsersModel' => $baseDir . '/app/Models/UsersModel.php',
    'Attribute' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Dotenv\\Dotenv' => $vendorDir . '/vlucas/phpdotenv/src/Dotenv.php',
    'Dotenv\\Exception\\ExceptionInterface' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ExceptionInterface.php',
    'Dotenv\\Exception\\InvalidEncodingException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidEncodingException.php',
    'Dotenv\\Exception\\InvalidFileException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidFileException.php',
    'Dotenv\\Exception\\InvalidPathException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidPathException.php',
    'Dotenv\\Exception\\ValidationException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ValidationException.php',
    'Dotenv\\Loader\\Loader' => $vendorDir . '/vlucas/phpdotenv/src/Loader/Loader.php',
    'Dotenv\\Loader\\LoaderInterface' => $vendorDir . '/vlucas/phpdotenv/src/Loader/LoaderInterface.php',
    'Dotenv\\Loader\\Resolver' => $vendorDir . '/vlucas/phpdotenv/src/Loader/Resolver.php',
    'Dotenv\\Parser\\Entry' => $vendorDir . '/vlucas/phpdotenv/src/Parser/Entry.php',
    'Dotenv\\Parser\\EntryParser' => $vendorDir . '/vlucas/phpdotenv/src/Parser/EntryParser.php',
    'Dotenv\\Parser\\Lexer' => $vendorDir . '/vlucas/phpdotenv/src/Parser/Lexer.php',
    'Dotenv\\Parser\\Lines' => $vendorDir . '/vlucas/phpdotenv/src/Parser/Lines.php',
    'Dotenv\\Parser\\Parser' => $vendorDir . '/vlucas/phpdotenv/src/Parser/Parser.php',
    'Dotenv\\Parser\\ParserInterface' => $vendorDir . '/vlucas/phpdotenv/src/Parser/ParserInterface.php',
    'Dotenv\\Parser\\Value' => $vendorDir . '/vlucas/phpdotenv/src/Parser/Value.php',
    'Dotenv\\Repository\\AdapterRepository' => $vendorDir . '/vlucas/phpdotenv/src/Repository/AdapterRepository.php',
    'Dotenv\\Repository\\Adapter\\AdapterInterface' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/AdapterInterface.php',
    'Dotenv\\Repository\\Adapter\\ApacheAdapter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ApacheAdapter.php',
    'Dotenv\\Repository\\Adapter\\ArrayAdapter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ArrayAdapter.php',
    'Dotenv\\Repository\\Adapter\\EnvConstAdapter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/EnvConstAdapter.php',
    'Dotenv\\Repository\\Adapter\\GuardedWriter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/GuardedWriter.php',
    'Dotenv\\Repository\\Adapter\\ImmutableWriter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ImmutableWriter.php',
    'Dotenv\\Repository\\Adapter\\MultiReader' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/MultiReader.php',
    'Dotenv\\Repository\\Adapter\\MultiWriter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/MultiWriter.php',
    'Dotenv\\Repository\\Adapter\\PutenvAdapter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/PutenvAdapter.php',
    'Dotenv\\Repository\\Adapter\\ReaderInterface' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ReaderInterface.php',
    'Dotenv\\Repository\\Adapter\\ReplacingWriter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ReplacingWriter.php',
    'Dotenv\\Repository\\Adapter\\ServerConstAdapter' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/ServerConstAdapter.php',
    'Dotenv\\Repository\\Adapter\\WriterInterface' => $vendorDir . '/vlucas/phpdotenv/src/Repository/Adapter/WriterInterface.php',
    'Dotenv\\Repository\\RepositoryBuilder' => $vendorDir . '/vlucas/phpdotenv/src/Repository/RepositoryBuilder.php',
    'Dotenv\\Repository\\RepositoryInterface' => $vendorDir . '/vlucas/phpdotenv/src/Repository/RepositoryInterface.php',
    'Dotenv\\Store\\FileStore' => $vendorDir . '/vlucas/phpdotenv/src/Store/FileStore.php',
    'Dotenv\\Store\\File\\Paths' => $vendorDir . '/vlucas/phpdotenv/src/Store/File/Paths.php',
    'Dotenv\\Store\\File\\Reader' => $vendorDir . '/vlucas/phpdotenv/src/Store/File/Reader.php',
    'Dotenv\\Store\\StoreBuilder' => $vendorDir . '/vlucas/phpdotenv/src/Store/StoreBuilder.php',
    'Dotenv\\Store\\StoreInterface' => $vendorDir . '/vlucas/phpdotenv/src/Store/StoreInterface.php',
    'Dotenv\\Store\\StringStore' => $vendorDir . '/vlucas/phpdotenv/src/Store/StringStore.php',
    'Dotenv\\Util\\Regex' => $vendorDir . '/vlucas/phpdotenv/src/Util/Regex.php',
    'Dotenv\\Util\\Str' => $vendorDir . '/vlucas/phpdotenv/src/Util/Str.php',
    'Dotenv\\Validator' => $vendorDir . '/vlucas/phpdotenv/src/Validator.php',
    'GrahamCampbell\\ResultType\\Error' => $vendorDir . '/graham-campbell/result-type/src/Error.php',
    'GrahamCampbell\\ResultType\\Result' => $vendorDir . '/graham-campbell/result-type/src/Result.php',
    'GrahamCampbell\\ResultType\\Success' => $vendorDir . '/graham-campbell/result-type/src/Success.php',
    'PHPMailer\\PHPMailer\\DSNConfigurator' => $vendorDir . '/phpmailer/phpmailer/src/DSNConfigurator.php',
    'PHPMailer\\PHPMailer\\Exception' => $vendorDir . '/phpmailer/phpmailer/src/Exception.php',
    'PHPMailer\\PHPMailer\\OAuth' => $vendorDir . '/phpmailer/phpmailer/src/OAuth.php',
    'PHPMailer\\PHPMailer\\OAuthTokenProvider' => $vendorDir . '/phpmailer/phpmailer/src/OAuthTokenProvider.php',
    'PHPMailer\\PHPMailer\\PHPMailer' => $vendorDir . '/phpmailer/phpmailer/src/PHPMailer.php',
    'PHPMailer\\PHPMailer\\POP3' => $vendorDir . '/phpmailer/phpmailer/src/POP3.php',
    'PHPMailer\\PHPMailer\\SMTP' => $vendorDir . '/phpmailer/phpmailer/src/SMTP.php',
    'PhpOption\\LazyOption' => $vendorDir . '/phpoption/phpoption/src/PhpOption/LazyOption.php',
    'PhpOption\\None' => $vendorDir . '/phpoption/phpoption/src/PhpOption/None.php',
    'PhpOption\\Option' => $vendorDir . '/phpoption/phpoption/src/PhpOption/Option.php',
    'PhpOption\\Some' => $vendorDir . '/phpoption/phpoption/src/PhpOption/Some.php',
    'PhpToken' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
    'Stringable' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
    'Symfony\\Polyfill\\Ctype\\Ctype' => $vendorDir . '/symfony/polyfill-ctype/Ctype.php',
    'Symfony\\Polyfill\\Mbstring\\Mbstring' => $vendorDir . '/symfony/polyfill-mbstring/Mbstring.php',
    'Symfony\\Polyfill\\Php80\\Php80' => $vendorDir . '/symfony/polyfill-php80/Php80.php',
    'Symfony\\Polyfill\\Php80\\PhpToken' => $vendorDir . '/symfony/polyfill-php80/PhpToken.php',
    'UnhandledMatchError' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
    'ValueError' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
);
