# BISS-TEA
Beverage Industry Sign Shop - Tracking Expense Accounts

A web service for tracking and reporting sign-making and POS expenses for beverage industry print shops.

The ultimate goal of this project is to allow a user from the sign shop to sign in and record their sign orders and pricing for reimbursement by supplier brands, and then later generate reports which list expenses and relevant data for arbitrary date ranges or for 6 month or 1 year ranges.

Database schema:
Table: Users
  - handle
  - email
  - password hash

Table: Orders
  - Order Description
  - Account / Brand
  - Price
  - Date of Production
  - Location of Installation (Route # or Location Name)
  - Sign shop responsible for making sign
  - Name of salesman who ordered sign
   
  
