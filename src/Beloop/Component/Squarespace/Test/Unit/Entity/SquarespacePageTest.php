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

namespace Beloop\Component\Squarespace\Test\Unit\Entity;

use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

use Beloop\Component\Course\Entity\Course;
use Beloop\Component\Course\Entity\CourseEnrolledUser;
use Beloop\Component\Course\Entity\Lesson;
use Beloop\Component\Squarespace\Entity\SquarespacePage;
use Beloop\Component\User\Entity\User;

class SquarespacePageTest extends PHPUnit_Framework_TestCase
{
    private $course;
    private $enrolment;
    private $lesson;
    private $page;
    private $user;

    public function setUp()
    {
        $this->course = new Course();
        $this->lesson = new Lesson();
        $this->page = new SquarespacePage();

        $this->user = new User();
        $this->user->setId(1);

        $this->enrolment = new CourseEnrolledUser();
        $this->enrolment->setUser($this->user);

        $this->page->setLesson($this->lesson);
        $this->lesson->setCourse($this->course);
        $this->course->setEnrollments(new ArrayCollection([ $this->enrolment ]));
    }

    public function testDefaultValues() {
        $this->assertEquals('squarespace_page', $this->page->getType());
    }

    public function testAvailability()
    {
        // Course and chapter start date is after today
        $this->enrolment->getEnrollmentDate()->add(DateInterval::createFromDateString("2 months"));
        $this->lesson->setOffsetInDays(60);
        $this->assertEquals(false, $this->page->isAvailableForUser($this->user));

        // Course is available and chapter start date is after today
        $this->enrolment->getEnrollmentDate()->add(DateInterval::createFromDateString("3 months"));
        $this->assertEquals(false, $this->page->isAvailableForUser($this->user));

        // Course is available and chapter start date is before today
        $this->enrolment->getEnrollmentDate()->sub(DateInterval::createFromDateString("5 months"));
        $this->lesson->setOffsetInDays(0);
        $this->assertEquals(true, $this->page->isAvailableForUser($this->user));

        // Course is over
        $this->enrolment->getEndDate()->sub(DateInterval::createFromDateString("8 months"));
        $this->assertEquals(false, $this->page->isAvailableForUser($this->user));
    }
}
