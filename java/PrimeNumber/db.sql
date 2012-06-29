LOAD DATA LOCAL INFILE 'C:/Development/prime/usortedprime114.prime'
INTO TABLE PrimeNumbers
LINES TERMINATED BY '\n'
(Prime);

SELECT * FROM PrimeNumbers ORDER BY Prime
INTO OUTFILE 'C:/Development/prime/sorted.prime' LINES TERMINATED BY '\n';
