## 序列号生成器

为多个code分别生成**连续数字**做为序列号。

@SeqGen: id, code(s), value&

每取一个值后value自动加1。
注意取序列号时应锁表，直到事务完成。若事务rollback，则value保持不变。

交互接口：

	SeqGen.next(seqCode?="default", cnt?=1)

后端内部接口：

	AC0_SeqGen::next(seqCode?="default", cnt?=1)
