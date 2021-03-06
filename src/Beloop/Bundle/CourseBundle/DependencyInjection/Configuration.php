<?php

/*
 * This file is part of the Beloop package.
 *
 * Copyright (c) 2016 AHDO Studio B.V.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Arkaitz Garro <arkaitz.garro@gmail.com>
 */

namespace Beloop\Bundle\CourseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Beloop\Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractConfiguration;

/**
 * Class Configuration.
 */
class Configuration extends AbstractConfiguration
{
    /**
     * {@inheritdoc}
     */
    protected function setupTree(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('mapping')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->append($this->addMappingNode(
                            'course',
                            'Beloop\Component\Course\Entity\Course',
                            '@BeloopCourseBundle/Resources/config/doctrine/Course.orm.yml',
                            'default',
                            true
                        ))
                        ->append($this->addMappingNode(
                            'course_enrolled_user',
                            'Beloop\Component\Course\Entity\CourseEnrolledUser',
                            '@BeloopCourseBundle/Resources/config/doctrine/CourseEnrolledUser.orm.yml',
                            'default',
                            true
                        ))
                        ->append($this->addMappingNode(
                            'lesson',
                            'Beloop\Component\Course\Entity\Lesson',
                            '@BeloopCourseBundle/Resources/config/doctrine/Lesson.orm.yml',
                            'default',
                            true
                        ))
                        ->append($this->addMappingNode(
                            'abstract_module',
                            'Beloop\Component\Course\Entity\Abstracts\AbstractModule',
                            '@BeloopCourseBundle/Resources/config/doctrine/AbstractModule.orm.yml',
                            'default',
                            true
                        ))
                        ->append($this->addMappingNode(
                            'page',
                            'Beloop\Component\Course\Entity\Page',
                            '@BeloopCourseBundle/Resources/config/doctrine/Page.orm.yml',
                            'default',
                            true
                        ))
                    ->end()
                ->end()
            ->end();
    }
}
