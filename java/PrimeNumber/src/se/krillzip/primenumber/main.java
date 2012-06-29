package se.krillzip.primenumber;

public class main {

	public static void main(String[] args) 
	{
		if(args.length > 0)
		{
			if(args[0].equalsIgnoreCase("--config")) {
				
			} else if(args[0].equalsIgnoreCase("--help")) {
				printMenu();
			} else if(args[0].equalsIgnoreCase("--local")) {
				printMenu();
			} else {
				System.out.print("Error: wrong command!\n type --help for instructions.");
			}
		} else {
			//printMenu();
			PrimeController.getInstance().start();
			System.out.println("Started PrimeController.");
		}
		while(true)
		{
			try {
				Thread.sleep(1000);
			} catch (InterruptedException e) {
			}
			System.out.println(PrimeController.getInstance().getCurrent());
		}
	}
	
	private static void printMenu()
	{
		String m = "Primes, is a software for finding all the primes in a 64 bit range.\n" +
		"The following commands are available:\n" +
		"    --local     for running locally.\n" +
		"    --config    for configuration.\n" +
		"    --help      for displaying this menu.";
		System.out.print(m);
	}

}
