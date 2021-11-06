<?php

namespace GamingEngine\Installation\Account\Steps;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Repositories\UserRepository;
use GamingEngine\Installation\Account\Requirements\AccountConfigurationRequirements;
use GamingEngine\Installation\Account\Requirements\AccountConfigurationValue;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class AccountDetailsStep extends BaseConfigurationStep
{
    public function __construct(private UserRepository $userRepository)
    {
        parent::__construct();
    }

    public function identifier(): string
    {
        return 'account';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.account.configuration.title');
    }

    public function apply(): void
    {
        $configuration = $this->checks()
            ->first()
            ->components()
            ->keyBy(fn (
                AccountConfigurationValue $value
            ) => $value->attribute())
            ->map(fn (AccountConfigurationValue $value) => $value->value())
            ->toArray();

        $this->userRepository->create(new UserDTO($configuration));
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect([
            new AccountConfigurationRequirements($this->overrides()),
        ]);
    }
}
