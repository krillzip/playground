package se.krillzip.primenumber;

public class PrimeBatch extends Thread{

	private long		num;
	private long		sqrtnum;
	private boolean		prime;
	
	public PrimeBatch()
	{
	}
	
	private boolean initialize(long n)
	{
		if(n != 0)
		{
			num = n;
			sqrtnum = (long) Math.ceil(Math.sqrt(n));
			prime = true;
			return true;
		}
		return false;
	}
	
	public void run() {
		try{
			while(initialize(PrimeController.getInstance().getNext()))
			{
				for(int i = 2; (i <= sqrtnum) && prime; i++)
				{
					if(num % i == 0)
					{
						prime = false;
					}
				}
				if(prime)
				{
						PrimeBuffer.getInstance().addPrime(num);
				}
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
	}
	
}
