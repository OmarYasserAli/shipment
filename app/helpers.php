<?php

namespace App;
class helpers
{

	static function put_tree_item($item){
		$ret = 
		'
		<details class="tree-nav__item is-expandable">
            <summary class="tree-nav__item-title">'.$item['name'].'</summary>';
                            
            if(isset($item['children'])){
            	foreach ($item['children'] as $key => $child) {
            	$ret.=helpers::put_tree_item($child);
            	}

            }
        $ret.='<details class="tree-nav__item is-expandable">
                <summary class="tree-nav__item-title"><apan class="add" data-parent="'.$item['id'].'">+اضافة</span></summary>
            </details>
    </details>
		';

		return $ret;
	}
}