<?php

namespace App\Services;

use App\Repositories\PageRepository;

class PageService
{
    protected $pageRepo;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepo = $pageRepo;
    }

    public function show($id)
    {
        $result = $this->pageRepo->show($id);

        return $result;
    }

    public function getBySlug($slug)
    {
        $page = $this->pageRepo->getPage([
            'slug' => $slug,
        ]);

        return $page;
    }

    public function getById($id)
    {
        $page = $this->pageRepo->getPage([
            'id' => $id,
        ]);

        return $page;
    }

    public function getPageUrl($slug)
    {
        return $this->pageRepo->getPageUrl($slug);
    }

    public function checkUrl($urlArr, $lastSlug)
    {
        $resultUrl = '';
        foreach ($urlArr as $url) {
            $page = $this->getPageUrl($url);
            $resultUrl = $resultUrl.$page->slug.'/';
        }

        return $resultUrl.$lastSlug;
    }

    public function getPaginated($path)
    {
        $pages = $this->pageRepo->getPaginated($path, config('app.admin_pagination'));

        return $pages;
    }

	public function create(array $data,$auth)
	{
		$data['created_user_id'] = $data['updated_user_id'] = $auth->id;

		$result = $this->pageRepo->create($data);

		return $result;
	}

	public function update(array $data, $id,$auth)
	{
		$data['updated_user_id'] = $auth->id;

		$result = $this->pageRepo->update($data, $id);

		return $result;
	}

	public function destroy(int $id)
	{
		$result = $this->pageRepo->destroy($id);

		return $result;
	}
}