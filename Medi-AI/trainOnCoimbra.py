from numpy import loadtxt
from keras.models import Sequential
from keras.layers import Dense
from keras import backend
import pymysql

def trainAndSave():
    backend.clear_session()
    print("Training Breast Cancer Model")
    # load the dataset
    dataset = loadtxt('Datasets/BreastCancerCoimbraDataSet.csv', delimiter=',')

    # split into input (X) and output (y) variables
    X = dataset[:,0:9]
    y = dataset[:,9]

    # define the keras model
    model = Sequential()
    model.add(Dense(12, input_dim=9, activation='relu'))
    model.add(Dense(8, activation='relu'))
    model.add(Dense(1, activation='sigmoid'))

    # compile the keras model
    model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

    # fit the keras model on the dataset
    model.fit(X, y, epochs=300, batch_size=3, verbose=1)

    # evaluate the keras model
    _, accuracy = model.evaluate(X, y)
    modelScore = accuracy*100

    #save the model
    modelJson = model.to_json()
    with open("breastCancerModel.json", "w") as json_file:
        json_file.write(modelJson)

    #save the weights
    model.save_weights("breastCancerModel.h5")
    print("Breast Cancer Model has been trained and saved")

    #save the accuracy to the database
    con = pymysql.connect('localhost','ubuntu', 'root','mediScreenDatabase')
    cur = con.cursor()
    cur.execute("update models set accuracy = "+str(modelScore)+ "where modelName = 'breastCancerModel';")
    con.commit()
    print("Data added to the database")
    con.close()
    backend.clear_session()
