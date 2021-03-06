<?php
/**
 * Defining Interface for class GetData.
 *
 * @package Ibonly\PotatoORM\ModelInterface
 * @author  Ibraheem ADENIYI <ibonly01@gmail.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 */

namespace Ibonly\PotatoORM;

interface GetDataInterface
{
	public function all();
	
    public function allDESC($limit);

    public function toArray();

    public function toJson();

    public function toJsonDecode();

    public function first();

   public function getCount();
}
