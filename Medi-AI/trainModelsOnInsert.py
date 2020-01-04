import pymysql
import time
import trainOnCleveland
import trainOnCoimbra
import trainOnPimaIndians

while(True):
    con = pymysql.connect('localhost', 'ubuntu', 'root', 'mediScreenDatabase')
    cur = con.cursor()
    cur.execute("select * from datasetUpdates where(updated = '1');")
    rows = cur.fetchall()
    if len(rows) == 0:
        print("Waiting for new data to retrain the machine learning models...")
        time.sleep(20)
    else:
        for row in rows:
            name = row[1]
            print(name)
            if name == "heartDisease":
                trainOnCleveland.trainAndSave()
            elif name =="breastCancer":
                trainOnCoimbra.trainAndSave()
            elif name =="diabetes":
                trainOnPimaIndians.trainAndSave()
            cur.execute("update datasetUpdates set updated = '0' where name = %s;",(name,))
            con.commit()
    con.close()
