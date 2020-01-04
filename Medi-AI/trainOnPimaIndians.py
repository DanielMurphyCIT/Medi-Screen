from numpy import loadtxt
from keras.models import Sequential
from keras.layers import Dense
from keras import backend
import pymysql

def trainAndSave():
    print("Training Diabetes Model...")
    # load the dataset
    dataset = loadtxt('Datasets/pima-indians-diabetes/pima-indians-diabetes.txt', delimiter=',')

    # split into input (X) and output (y) variables
    X = dataset[:,0:8]
    y = dataset[:,8]

    # define the keras model
    model = Sequential()
    model.add(Dense(12, input_dim=8, activation='relu'))
    model.add(Dense(8, activation='relu'))
    model.add(Dense(1, activation='sigmoid'))

    # compile the keras model
    model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

    # fit the keras model on the dataset
    model.fit(X, y, epochs=300, batch_size=3, verbose=0)

    # evaluate the keras model
    _, accuracy = model.evaluate(X, y)
    modelScore = accuracy*100

    # save the model
    modelJson = model.to_json()
    with open ("diabetesModel.json","w") as json_file:
        json_file.write(modelJson)

    # save the weights
    model.save_weights("diabetesModel.h5")
    print("Diabetes model has been trained and saved")

    # save the accuracy to the database
    con = pymysql.connect("localhost", "ubuntu", "root", "mediScreenDatabase")
    cur = con.cursor()
    cur.execute("update models set accuracy = "+str(modelScore)+" where modelName = 'diabetesModel';")
    con.commit()
    print("Data added to the database")
    con.close()
    backend.clear_session()
