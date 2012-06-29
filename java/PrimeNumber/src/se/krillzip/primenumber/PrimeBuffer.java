package se.krillzip.primenumber;

import java.io.FileOutputStream;

public class PrimeBuffer{

	private static PrimeBuffer instance;
	private FileOutputStream outstr;
	private int fcount;
	private int pcount;
	private boolean swapfileflag;
	
	private PrimeBuffer() throws Exception
	{		
		try {
			outstr = new FileOutputStream("usortedprime" + fcount + ".prime", true);
		} catch (Exception e) {
			throw e;
		}
		fcount = 0;
		pcount = 0;
		swapfileflag = false;
	}
	
	public static synchronized PrimeBuffer getInstance()
	{
	      if (instance == null) try {
				instance = new PrimeBuffer();
			} catch (Exception e) {
				e.printStackTrace();
			}
	      return instance;
	}
	
	public Object clone() throws CloneNotSupportedException
	{
		throw new CloneNotSupportedException();
	}
	
	protected void finalize() throws Throwable 
	{
		super.finalize();
	}
	
	public synchronized void addPrime(long p) throws Exception
	{
		if(pcount == 1000000) swapfileflag = true;
		String str = new String(Long.toString(p) + "\r\n");
		try {
			outstr.write(str.getBytes());
			pcount++;
		} catch (Exception e) {
			throw e;
		}
	}
	
	public synchronized void swapfile() throws Exception
	{
		try {
			outstr.close();
			outstr = new FileOutputStream("usortedprime" + ++fcount + ".prime", true);
		} catch(Exception e) {
			throw e;
		}
		swapfileflag = false;
		pcount = 0;
		System.out.println("Changed file to: " + fcount);
	}
	
	public synchronized boolean swapflag()
	{
		return swapfileflag;
	}

}
