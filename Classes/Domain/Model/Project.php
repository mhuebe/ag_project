<?php
namespace AG\AgProject\Domain\Model;

/**
 *
 *  Copyright notice
 *
 *  (c) 2015
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */

/**
 * Product
 */
class Project extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * title
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * client
	 *
	 * @var string
	 */
	protected $client;

	/**
	 * websiteUrl
	 *
	 * @var string
	 */
	protected $websiteUrl;

	/**
	 * images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $images = NULL;

	/**
	 * status
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Status>
	 * @cascade remove
	 */
	protected $status = NULL;

	/**
	 * category
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Category>
	 * @cascade remove
	 */
	protected $category = NULL;

	/**
	 * relatedProjects
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Project>
	 */
	protected $relatedProjects = NULL;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * Returns the client
	 *
	 * @return string $client
	 */
	public function getClient()
	{
		return $this->client;
	}

	/**
	 * Sets the client
	 *
	 * @param string $client
	 * @return void
	 */
	public function setClient($client)
	{
		$this->client = $client;
	}

	/**
	 * Returns the websiteUrl
	 *
	 * @return string $websiteUrl
	 */
	public function getWebsiteUrl()
	{
		return $this->websiteUrl;
	}

	/**
	 * Sets the websiteUrl
	 *
	 * @param string $websiteUrl
	 * @return void
	 */
	public function setWebsiteUrl($websiteUrl)
	{
		$this->websiteUrl = $websiteUrl;
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages()
	{
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages($images)
	{
		$this->images = $images;
	}

	/**
	 * __construct
	 */
	public function __construct()
	{
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		$this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->relatedProjects = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->status = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Category
	 *
	 * @param \AG\AgProject\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\AG\AgProject\Domain\Model\Category $category)
	{
		$this->category->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param \AG\AgProject\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\AG\AgProject\Domain\Model\Category $categoryToRemove)
	{
		$this->category->detach($categoryToRemove);
	}

	/**
	 * Returns the category
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Category> category
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Category> $category
	 * @return void
	 */
	public function setCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $category)
	{
		$this->category = $category;
	}

	/**
	 * Adds a RelatedProjects
	 *
	 * @param \AG\AgProject\Domain\Model\RelatedProjects $relatedProjects
	 * @return void
	 */
	public function addRelatedProjects(\AG\AgProject\Domain\Model\RelatedProjects $relatedProjects)
	{
		$this->relatedProjects->attach($relatedProjects);
	}

	/**
	 * Removes a RelatedProjects
	 *
	 * @param \AG\AgProject\Domain\Model\RelatedProjects $relatedProjectsToRemove The RelatedProjects to be removed
	 * @return void
	 */
	public function removeRelatedProjects(\AG\AgProject\Domain\Model\RelatedProjects $relatedProjectsToRemove)
	{
		$this->relatedProjects->detach($relatedProjectsToRemove);
	}

	/**
	 * Returns the relatedProjects
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\RelatedProjects> relatedProjects
	 */
	public function getRelatedProjects()
	{
		return $this->relatedProjects;
	}

	/**
	 * Sets the relatedProjects
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\RelatedProjects> $relatedProjects
	 * @return void
	 */
	public function setRelatedProjects(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedProjects)
	{
		$this->relatedProjects = $relatedProjects;
	}

	/**
	 * Adds a Status
	 *
	 * @param \AG\AgProject\Domain\Model\Status $status
	 * @return void
	 */
	public function addStatus(\AG\AgProject\Domain\Model\Status $status)
	{
		$this->status->attach($status);
	}

	/**
	 * Removes a Status
	 *
	 * @param \AG\AgProject\Domain\Model\Status $statusToRemove The Status to be removed
	 * @return void
	 */
	public function removeStatus(\AG\AgProject\Domain\Model\Status $statusToRemove)
	{
		$this->status->detach($statusToRemove);
	}

	/**
	 * Returns the status
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Status> status
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AG\AgProject\Domain\Model\Status> $status
	 * @return void
	 */
	public function setStatus(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $status)
	{
		$this->status = $status;
	}

}