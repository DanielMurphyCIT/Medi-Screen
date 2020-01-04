import numpy as np
from keras.models import Sequential
from keras.layers import Dense
from keras.wrappers.scikit_learn import KerasClassifier
from keras.utils import np_utils
from sklearn.model_selection import cross_val_score
from sklearn.model_selection import KFold
from sklearn.preprocessing import LabelEncoder
from keras import backend
import pymysql

def trainAndSave():
    print("Training Heart Disease Model...")
    # load the dataset
    dataset = np.loadtxt('Datasets/Heart Disease/processed.cleveland.data', delimiter=',', skiprows=1)

    # split into input (X) and output (y) variables

    X = dataset[:, 0:13]
    Y = dataset[:, 13]

    # encode class values as integers
    encoder = LabelEncoder()
    encoder.fit(Y)
    encoded_Y = encoder.transform(Y)

    # convert integers to dummy variables (i.e. one hot encoded)
    dummy_y = np_utils.to_categorical(encoded_Y)

    # define baseline model
    def baseline_model():
        # create model
        model = Sequential()
        model.add(Dense(8, input_dim=13, activation='relu'))
        model.add(Dense(5, activation='softmax'))
        # Compile model
        model.compile(loss='categorical_crossentropy', optimizer='adam', metrics=['accuracy'])
        return model


    estimator = KerasClassifier(build_fn=baseline_model, epochs=200, batch_size=5, verbose=0)
    kfold = KFold(n_splits=2, shuffle=True)
    results = cross_val_score(estimator, X, dummy_y, cv=kfold)
    model = baseline_model()

    modelScore = results.mean()*100

    # Save the model
    modelJson = model.to_json()
    with open("heartDiseaseModel.json","w") as json_file:
        json_file.write(modelJson)

    # Save the weights
    model.save_weights("heartDiseaseModel.h5")
    print("Heart Disease Model has been trained and saved")

    # Save the accuracy to the database
    con = pymysql.connect('localhost', 'ubuntu', 'root', 'mediScreenDatabase')
    cur = con.cursor()
    cur.execute("update models set accuracy = "+str(modelScore)+" where modelName = 'heartDiseaseModel';")
    con.commit()
    print("Data has been added to the database")
    con.close()
    backend.clear_session()

