# 序列号生成

seqgen: sequence generator

## 用法

安装：

	./tool/jdcloud-plugin.sh add ../jdcloud-plugin-seqgen

提供了管理端页面。若要添加该页面，建议放在系统管理主菜单中，添加菜单项store.html:

		<a href="#pageSeqGen">序列号生成器</a>

## 设计

为多个code分别生成**连续数字**做为序列号。

@SeqGen: id, code(s), value&

每取一个值后value自动加1。
注意取序列号时应锁表，直到事务完成。若事务rollback，则value保持不变。

交互接口：

	SeqGen.next(code?="default")

后端内部接口：

	AC0_SeqGen::next(code?="default")

