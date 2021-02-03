<?php

// sequence generator
class AC0_SeqGen extends AccessControl
{
	static function next($seqCode = "default", $cnt = 1)
	{
		if (!$seqCode || $cnt <= 0)
			throw new MyException(E_PARAM);
		// "for update"用于锁记录
		list ($id, $value) = queryOne("SELECT id, value FROM SeqGen WHERE code=" . Q($seqCode) . " FOR UPDATE");
		if (!$value)
			$value = 0;
		$value += $cnt;
		global $g_conf_seqGen_onNext;
		if (is_callable($g_conf_seqGen_onNext))
			$g_conf_seqGen_onNext($value);
		if (! $id) {
			dbInsert("SeqGen", ["code"=>$seqCode, "value"=>$value]);
		}
		else {
			dbUpdate("SeqGen", ["value"=>$value], $id);
		}
		return $value;
	}

	function api_next()
	{
		return self::next(param("seqCode", "default"), param("cnt", 1));
	}
}

class AC2_SeqGen extends AC0_SeqGen
{
}
