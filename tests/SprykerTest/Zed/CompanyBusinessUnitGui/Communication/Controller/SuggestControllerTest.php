<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerTest\Zed\CompanyBusinessUnitGui\Communication\Controller;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\CompanyBusinessUnitGui\Communication\CompanyBusinessUnitGuiCommunicationFactory;
use Spryker\Zed\CompanyBusinessUnitGui\Communication\Controller\SuggestController;
use Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiConfig;
use SprykerTest\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiBusinessTester;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group CompanyBusinessUnitGui
 * @group Communication
 * @group Controller
 * @group SuggestControllerTest
 * Add your own group annotations below this line
 */
class SuggestControllerTest extends Unit
{
    protected const string SEARCH_TERM = 'AllCompaniesSuggestUnit';

    protected const string KEY_RESULTS = 'results';

    protected const string KEY_ID = 'id';

    protected const string KEY_TEXT = 'text';

    protected CompanyBusinessUnitGuiBusinessTester $tester;

    public function testAllCompaniesActionSuggestsBusinessUnitsOfEveryCompanyWithoutCompanyParameter(): void
    {
        // Arrange
        $firstCompanyBusinessUnitTransfer = $this->haveCompanyBusinessUnitInNewCompany(static::SEARCH_TERM . ' North');
        $secondCompanyBusinessUnitTransfer = $this->haveCompanyBusinessUnitInNewCompany(static::SEARCH_TERM . ' South');

        // Act
        $results = $this->requestAllCompaniesSuggestions(static::SEARCH_TERM, $this->createSuggestController());

        // Assert
        $this->assertEqualsCanonicalizing(
            [
                $firstCompanyBusinessUnitTransfer->getIdCompanyBusinessUnitOrFail(),
                $secondCompanyBusinessUnitTransfer->getIdCompanyBusinessUnitOrFail(),
            ],
            array_column($results, static::KEY_ID),
        );
    }

    public function testAllCompaniesActionLabelsEachSuggestionWithItsCompanyName(): void
    {
        // Arrange
        $companyTransfer = $this->tester->haveCompany([CompanyTransfer::IS_ACTIVE => true]);
        $this->tester->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::NAME => static::SEARCH_TERM . ' Labelled',
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompanyOrFail(),
        ]);

        // Act
        $results = $this->requestAllCompaniesSuggestions(static::SEARCH_TERM, $this->createSuggestController());

        // Assert
        $this->assertCount(1, $results);
        $this->assertStringContainsString(static::SEARCH_TERM . ' Labelled', $results[0][static::KEY_TEXT]);
        $this->assertStringContainsString($companyTransfer->getNameOrFail(), $results[0][static::KEY_TEXT]);
    }

    public function testAllCompaniesActionReturnsAtMostTheSuggestionLimit(): void
    {
        // Arrange
        $this->haveCompanyBusinessUnitInNewCompany(static::SEARCH_TERM . ' First');
        $this->haveCompanyBusinessUnitInNewCompany(static::SEARCH_TERM . ' Second');

        // Act
        $results = $this->requestAllCompaniesSuggestions(static::SEARCH_TERM, $this->createSuggestController(1));

        // Assert
        $this->assertCount(1, $results);
    }

    protected function haveCompanyBusinessUnitInNewCompany(string $companyBusinessUnitName): CompanyBusinessUnitTransfer
    {
        $companyTransfer = $this->tester->haveCompany([CompanyTransfer::IS_ACTIVE => true]);

        return $this->tester->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::NAME => $companyBusinessUnitName,
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompanyOrFail(),
        ]);
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function requestAllCompaniesSuggestions(string $term, SuggestController $suggestController): array
    {
        $response = $suggestController->allCompaniesAction(new Request(['term' => $term]));

        return json_decode((string)$response->getContent(), true)[static::KEY_RESULTS];
    }

    protected function createSuggestController(?int $suggestionLimit = null): SuggestController
    {
        $companyBusinessUnitGuiCommunicationFactory = new CompanyBusinessUnitGuiCommunicationFactory();

        if ($suggestionLimit !== null) {
            $companyBusinessUnitGuiCommunicationFactory->setConfig($this->createConfigWithSuggestionLimit($suggestionLimit));
        }

        return new class ($companyBusinessUnitGuiCommunicationFactory) extends SuggestController {
            public function __construct(CompanyBusinessUnitGuiCommunicationFactory $companyBusinessUnitGuiCommunicationFactory)
            {
                $this->factory = $companyBusinessUnitGuiCommunicationFactory;
            }
        };
    }

    protected function createConfigWithSuggestionLimit(int $suggestionLimit): CompanyBusinessUnitGuiConfig
    {
        return new class ($suggestionLimit) extends CompanyBusinessUnitGuiConfig {
            public function __construct(protected int $suggestionLimit)
            {
            }

            public function getCompanyBusinessUnitSuggestionLimit(): int
            {
                return $this->suggestionLimit;
            }
        };
    }
}
