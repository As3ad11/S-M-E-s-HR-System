

## About The project

Guide to run laravel website
1. Open folder of project.
2. Hold shift + right-click to open option menu.
3. Find 'Open PowerShell window here' option and click on it.
4. Type 'php artisan serve' then enter.
5. Let the PowerShell window remain open. If close, the website unable to run. Just minimize the PowerShell window.
6. Find the url link from PowerShell window. And open it on browser. Your website now running.
7. To close the server to keep running, you can close the PowerShell right away or `ctrl + c` to stop the services.

Guide to change existing user become Admin role.
1. Open DBeaver software - this is database manager software.
2. Open your project database and find 'users' table.
3. Right-click on it and select 'View table' then select 'Data' tab.
4. From there you can see 'role' field. Change the value by double click on desired user. Below is role code for your reference
	a. 1 = Admin
	b. 2 - Employee
	c. 3 - Manager
	d. 4 - Employer
	
Guide to change system name
1. Open folder of project.
2. Find .env file and click edit.
3. Find 'APP_NAME' and change its value as desired. If the value you about to set is required space, wrap the value with double quotes for example:
	APP_NAME="E Human Resource"
4. Save the file and restart the 'php artisan serve' again on command line.
