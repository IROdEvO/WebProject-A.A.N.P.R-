<?php

	fuction hasInvalidCharacters($text){
		return (bool) preg_match('/["!@#$%^&*()_+<>?:"{}|]/u',$text);
	}