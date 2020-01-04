import pymysql
con = pymysql.connect('localhost', 'ubuntu', 'root', 'mediScreenDatabase')
cur = con.cursor()
cur.execute("Select * from doctors")
rows = cur.fetchall()
for row in rows:
   print(row)

print("all done")
