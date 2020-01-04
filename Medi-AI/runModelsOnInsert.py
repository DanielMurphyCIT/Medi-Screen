import numpy as np
from keras.wrappers.scikit_learn import KerasClassifier
from keras.utils import np_utils
from sklearn.model_selection import cross_val_score
from sklearn.model_selection import KFold
from keras.models import model_from_json
import pymysql
import time

def loadModel(name):
	#load and create model
	jsonFilename = name+".json"
	h5Filename = name+".h5"
	jsonFile = open(jsonFilename,'r')
	loadedModel = jsonFile.read()
	jsonFile.close()
	loadedModel = model_from_json(loadedModel)

	#load weights
	loadedModel.load_weights(h5Filename)
	print("Loaded Model From Disk")
	return loadedModel

con = pymysql.connect('localhost', 'ubuntu', 'root', 'mediScreenDatabase')
cur = con.cursor()
running = True
while running:
	cur.execute("select * from medicalHistory where(beenCalculated = 0);")
	rows = cur.fetchall()
	if len(rows) == 0:
		print("Sleep...")
		time.sleep(10)
	else:
		diabetesModel = loadModel("diabetesModel")
		heartDiseaseModel = loadModel("heartDiseaseModel")
		breastCancerModel = loadModel("breastCancerModel")
		for row in rows:
			pID = int(row[1])
			mhID = int(row[0])
			diabetesData = np.array([[row[12],row[13],row[14],row[15],row[5],row[3],row[16],row[2]]])
			prediction1 = diabetesModel.predict_classes(diabetesData, batch_size=1, verbose = 1)
			heartDiseaseData = np.array([[row[2], row[6],row[14], row[17], row[18], row[19], row[20], row[21], row[22], row[23], row[24], row[25], row[26]]])
			prediction2 = heartDiseaseModel.predict_classes(heartDiseaseData, batch_size=1, verbose = 1)
			breastCancerData = np.array([[row[2], row[3], row[4], row[5], row[7], row[8], row[9], row[10], row[11]]])
			prediction3 = breastCancerModel.predict_classes(breastCancerData, batch_size=1, verbose = 1)
			cur.execute("update medicalHistory set beenCalculated = '1' where patientID = %s;",(pID,))
			con.commit()
			cur.execute("insert into predictions(patientID, medicalHistoryID, heartDisease, diabetes, breastCancer) values(%s, %s, %s, %s, %s);",(pID, mhID, int(prediction2), int(prediction1), int(prediction3),))
			con.commit()
