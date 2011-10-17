Elgg user importer from CSV files

CSV File
========
CSV files can be created by spreadsheet programs like Microsoft Excel by using the
Save As option selecting the CSV format option. A csv file often has a header line
followed by a set of individual records like this:

	username,name,email
	george,George,george@test.com
	matt,Matt,matt@test.com
	sally,Sally,sally@test.com


CSV Header
==========
The importer provides three options for parsing the header line:

 1. There is no header so treat the first line as a user record
 2. Skip the first line
 3. Use the names in the header to define the mapping from column to field name


Fields
======
The three required fields are username, name, and email. There are two optional
fields of password and icon. If the 3rd header option of using the column names
is selected, custom fields can also be defined (but requires an additional
plugin). If using the 1st or 2nd header option, the columns must be ordered as
username, name, email, password, icon with the last two being optional.

If the password column is not defined or the password is blank, a random password
is assigned to the user.

The icon must be the filename with full path of an image located on the server.
The web server must have permission to read the file. An example filename with
path is '/home/user/icons/george.jpg'. If you use the 1st or 2nd header options,
you must include the password column to add an icon.


Notifications
=============
Email notifications of the new accounts can be sent to the users. This is very
important if using the random password assignment. Please test email notifications
on your server before importing users.
