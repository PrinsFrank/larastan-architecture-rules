<?php

declare(strict_types=1);

namespace PrinsFrank\LarastanArchitectureRules\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @implements Rule<Class_>
 */
class UnitTestsShouldExtendFromBasePHPUnitTestCase implements Rule
{
    public function getNodeType(): string
    {
        return Class_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var Class_ $node */
        if ($node->extends === null || $node->namespacedName === null) {
            return [];
        }

        $FQN = $node->namespacedName->toString();
        if (str_contains($FQN, '\\Test\\') === false && str_contains($FQN, '\\Tests\\') === false) {
            return [];
        }

        if ($node->extends->toString() === TestCase::class || str_contains($FQN, '\\Unit\\') === false) {
            return [];
        }

        return [
            RuleErrorBuilder::message(
                'Please make sure to extend from "' . TestCase::class . '" for Unit tests. If this is not a Unit test, ' .
                'move it out of the \\Unit\\ namespace to a \\Integration\\ or \\Feature\\ namespace.'
            )->line($node->getLine())->build(),
        ];
    }
}
