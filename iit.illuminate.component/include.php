<?php

use Bitrix\Main\Loader;
use IIT\Entity\Module\Html;
use IIT\Entity\Module\Option;
use IIT\Illuminate\App\Http\Controllers\ApiController;
use IIT\Illuminate\App\Http\Middleware\BasicAuth;
use IIT\Illuminate\App\Http\Middleware\SessId;
use IIT\Illuminate\App\Http\Requests\ApiFormRequest;
use IIT\Illuminate\App\Models\B24\Company\Company;
use IIT\Illuminate\App\Models\B24\Contact\CompanyProperty;
use IIT\Illuminate\App\Models\B24\Contact\Contact;
use IIT\Illuminate\App\Models\B24\Contact\ContactProperty;
use IIT\Illuminate\App\Models\B24\Contact\DealProperty;
use IIT\Illuminate\App\Models\B24\ContactCompany;
use IIT\Illuminate\App\Models\B24\CrmFieldMulti;
use IIT\Illuminate\App\Models\B24\Deal\Deal;
use IIT\Illuminate\App\Models\B24\DealContact;
use IIT\Illuminate\App\Models\B24\File;
use IIT\Illuminate\App\Models\B24\UserFieldEnum;
use IIT\Illuminate\App\Models\Base;
use IIT\Illuminate\App\Models\Bitrix\Iblock;
use IIT\Illuminate\App\Models\Bitrix\IblockSection;
use IIT\Illuminate\App\Models\Bitrix\IblockSectionChildren;
use IIT\Illuminate\App\Models\Bitrix\User;
use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Illuminate\App\Repositories\EloquentRepositoryInterface;
use IIT\Illuminate\App\Services\Container;
use IIT\Illuminate\App\Services\Service;
use IIT\Illuminate\Component\SettingsTable;
use IIT\Illuminate\Eloquent\Database\Connection;
use IIT\Illuminate\Facades\Routing;
use IIT\Illuminate\Handlers\ErrorHandler;
use IIT\Illuminate\ModuleSettings;
use IIT\Illuminate\Validator\ValidatorFactory;

require_once $_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/vendor/autoload.php';

Loader::registerAutoLoadClasses(
    'iit.illuminate.component',
    [
        Html::class           => "/classes/general/Html.php",
        Option::class         => "/classes/general/Option.php",
        SettingsTable::class  => "/classes/general/Orm/SettingsTable.php",
        ModuleSettings::class => "/classes/general/ModuleSettings.php",
        ErrorHandler::class   => "/classes/general/Handlers/ErrorHandler.php",

        Connection::class       => "/classes/general/Eloquent/Connection.php",
        Routing::class          => "/classes/general/Routing/Routing.php",
        ValidatorFactory::class => "/classes/general/Validation/ValidatorFactory.php",

        ApiController::class => '/classes/general/app/Http/Controllers/ApiController.php',
        BasicAuth::class     => '/classes/general/app/Http/Middleware/BasicAuth.php',
        SessId::class        => '/classes/general/app/Http/Middleware/SessId.php',

        Base::class => '/classes/general/app/Models/Base.php',

        EloquentRepository::class          => '/classes/general/app/Repositories/EloquentRepository.php',
        EloquentRepositoryInterface::class => '/classes/general/app/Repositories/EloquentRepositoryInterface.php',


        Contact::class         => '/classes/general/app/Models/B24/Contact/Contact.php',
        ContactProperty::class => '/classes/general/app/Models/B24/Contact/ContactProperty.php',

        Deal::class         => '/classes/general/app/Models/B24/Deal/Deal.php',
        DealProperty::class => '/classes/general/app/Models/B24/Deal/DealProperty.php',

        Company::class         => '/classes/general/app/Models/B24/Company/Company.php',
        CompanyProperty::class => '/classes/general/app/Models/B24/Company/CompanyProperty.php',

        CrmFieldMulti::class  => '/classes/general/app/Models/B24/CrmFieldMulti.php',
        ContactCompany::class => '/classes/general/app/Models/B24/ContactCompany.php',
        DealContact::class    => '/classes/general/app/Models/B24/DealContact.php',

        File::class => '/classes/general/app/Models/B24/File.php',

        ApiFormRequest::class => '/classes/general/app/Http/Requests/ApiFormRequest.php',

        Service::class   => '/classes/general/app/Services/Service.php',
        Container::class => '/classes/general/app/Services/Container.php',

        User::class          => '/classes/general/app/Models/Bitrix/User.php',
        IblockSection::class => '/classes/general/app/Models/Bitrix/IblockSection.php',
        Iblock::class => '/classes/general/app/Models/Bitrix/Iblock.php',
        UserFieldEnum::class => '/classes/general/app/Models/Bitrix/UserFieldEnum.php',
    ]
);
