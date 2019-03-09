<?php
/**
 * Created by IntelliJ IDEA.
 * User: vladislav
 * Date: 3/8/19
 * Time: 2:03 PM
 */

namespace common\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
	/**
	 * @param $attrs
	 * @param $rawData
	 * @return array
	 * @desc This method filters parameters
	 */
	protected function readParams($attrs, $rawData)
	{
		$data = [];

		foreach ($attrs as $key => $attribute) {

			if (is_array($attribute)) {

				if (!isset( $rawData[$key] )) continue;

				$data[$key] = $this->readParams($attribute, $rawData[$key]);

			} else {

				if (!isset( $rawData[$attribute] )) continue;

				$data[$attribute] = $rawData[$attribute];
			}
		}

		return $data;
	}

	/**
	 * @return array
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function getAllowedBody()
	{
		$attrs = $this->allowedAttributes();

		$data  = \Yii::$app->getRequest()->getBodyParams();

		if (!isset( $attrs[$this->action->id] ))
			return $data;

		return $this->readParams($attrs[$this->action->id], $data);
	}

	/**
	 * @return array|mixed
	 */
	protected function getAllowedPost()
	{
		$attrs = $this->allowedAttributes();

		$post  = \Yii::$app->getRequest()->post();

		if (!isset( $attrs[$this->action->id] ))
			return $post;

		return $this->readParams($attrs[$this->action->id], $post);
	}

	/**
	 * @return array|mixed
	 */
	protected function getAllowedGet()
	{
		$attrs = $this->allowedAttributes();

		$get   = \Yii::$app->getRequest()->get();

		if (!isset( $attrs[$this->action->id] ))
			return $get;

		return $this->readParams($attrs[$this->action->id], $get);
	}

	/**
	 * @return array
	 */
	public function allowedAttributes()
	{
		return [];
	}
}