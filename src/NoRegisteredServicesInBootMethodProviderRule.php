<?php
declare(strict_types=1);

namespace PrinsFrank\LarastanArchitectureRules\Rules;

use Illuminate\Support\ServiceProvider;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<MethodCall>
 */
class NoRegisteredServicesInBootMethodProviderRule implements Rule
{
    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var MethodCall $node */
        $classReflection = $scope->getClassReflection();
        if ($classReflection === null || $classReflection->isSubclassOf(ServiceProvider::class) === false) {
            return [];
        }

        if ($scope->getFunctionName() !== 'boot') {
            return [];
        }

        /** @var Node\Expr\PropertyFetch $propertyFetch */
        $propertyFetch = $node->var;

        /** @var Node\Expr\Variable $var */
        $var = $propertyFetch->var;
        if ((string) $propertyFetch->name !== 'app' || (string) $var->name !== 'this' || (string) $node->name !== 'register') {
            return [];
        }

        return [
            RuleErrorBuilder::message(
                'Service providers should not be registered in boot methods of other service providers as that will ' .
                'create conflicts when service providers depend on each other. Please register them in the register 
                method or the kernel instead.'
            )->line($node->getLine())->build(),
        ];
    }
}
