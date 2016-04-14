<?php

/*
 * This file is part of the DYB package.
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

namespace DYB\Component\Course\Entity;

use \DateTime;
use \DateInterval;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use DYB\Component\Core\Entity\Traits\DateTimeTrait;
use DYB\Component\Core\Entity\Traits\EnabledTrait;
use DYB\Component\Core\Entity\Traits\IdentifiableTrait;

/**
 * Class Course entity.
 */
class Course
{
    use IdentifiableTrait,
        EnabledTrait,
        DateTimeTrait;

    protected $code;
    protected $name;
    protected $slug;
    protected $description;
    protected $chapters;
    protected $startDate;
    protected $endDate;

    /**
     * Course constructor.
     */
    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->startDate = new DateTime();
        $this->endDate = new DateTime();
        $this->endDate->add(DateInterval::createFromDateString("6 months"));
        $this->enable();
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return $this Self object
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this Self object
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return $this Self object
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this Self object
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @param Collection $chapters
     * @return $this Self object
     */
    public function setChapters(Collection $chapters)
    {
        $this->chapters = $chapters;
        return $this;
    }

    /**
     * @param Chapter $chapter
     * @return $this Self object
     */
    public function addChapter(Chapter $chapter)
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
        }

        return $this;
    }

    /**
     * @param Chapter $chapter
     * @return $this Self object
     */
    public function removeChapter(Chapter $chapter)
    {
        $this
            ->chapters
            ->removeElement($chapter);

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     * @return $this Self object
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     * @return $this Self object
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }
}