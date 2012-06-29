package se.krillzip.primenumber;

public class PrimeController extends Thread{
	
	private static PrimeController instance;
	
	private long calc;
	
	private int tnum;
	private PrimeBatch[] th;  
	
	PrimeController()
	{
		calc = 2;
		tnum = 3;
		th = new PrimeBatch[tnum];
	}
	
	public static synchronized PrimeController getInstance()
	{
	      if (instance == null)
	          instance = new PrimeController();
	      return instance;
	}
	
	public Object clone() throws CloneNotSupportedException
	{
		throw new CloneNotSupportedException();
	}
	
	protected void finalize() throws Throwable 
	{
		try {

	    } finally {
	        super.finalize();
	    }
	}

	public void run() 
	{
		try {
			while(true)
			{
				sleep100();
				if(PrimeBuffer.getInstance().swapflag()) synchPrimeBuffer();
				if(!checkAllThreadsAlive()) initializeThreads();
			}
		} catch (Exception e){
			e.printStackTrace();
		}
	}
	
	private void synchPrimeBuffer() throws Exception
	{
		System.out.println("Begin thread wait before file swap.");
		while(checkNoThreadsAlive()) sleep100();
		PrimeBuffer.getInstance().swapfile();
		initializeThreads();
	}

	private void initializeThreads()
	{
		for(int i = 0; i < th.length; i++)
		{
			if(th[i] == null) {
				th[i] = new PrimeBatch();
				th[i].setPriority(Thread.MIN_PRIORITY);
				th[i].start();
			} else if(!th[i].isAlive()) {
				th[i] = new PrimeBatch();
				th[i].setPriority(Thread.MIN_PRIORITY);
				th[i].start();
			}
		}
	}
	
	private boolean checkAllThreadsAlive()
	{
		boolean r = true;
		for(int i = 0; i < th.length; i++)
			if(!(th[i] == null))
			{
				if(!th[i].isAlive()) r = false;
			} else{
				r = false;
			}
		
		return r;
	}
	
	private boolean checkNoThreadsAlive()
	{
		boolean r = true;
		for(int i = 0; i < th.length; i++)
			if(th[i].isAlive()) r = false;
		
		return r;
	}
	
	private void sleep100()
	{
		try {
			sleep(100);
		} catch (InterruptedException e) {;}
	}
	
	public synchronized long getCurrent()
	{
		return calc;
	}
	
	public synchronized long getNext()
	{
		return calc++;
	}
}
