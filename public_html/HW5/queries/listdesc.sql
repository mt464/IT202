SELECT * FROM BankAccounts WHERE AccountNumber CONCAT('%', :thing, '%') ORDER BY DESC