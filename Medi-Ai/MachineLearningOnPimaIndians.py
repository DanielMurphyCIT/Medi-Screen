# first neural network with keras tutorial
from numpy import loadtxt
from keras.models import Sequential
from keras.layers import Dense
import time

overallFalsePositive = []
overallPercentages = []
counter = 0
while counter < 10:
    # Get start time
    startTime = time.time()
    # load the dataset
    dataset = loadtxt('C:\\Users\\zacda\\PycharmProjects\\untitled\\Datasets\\pima-indians-diabetes\\pima-indians-diabetes.txt', delimiter=',')

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
    model.fit(X, y, epochs=300, batch_size=3)

    # evaluate the keras model
    _, accuracy = model.evaluate(X, y)
    print('Accuracy: %.2f' % (accuracy*100))

    # load test dataset
    testDataset = dataset = loadtxt('C:\\Users\\zacda\\PycharmProjects\\untitled\\Datasets\\pima-indians-diabetes\\pima-indians-diabetes-testFull.txt', delimiter=',')

    # predict using the test dataset
    predictions = model.predict(testDataset, batch_size=1, verbose=0)

    # print outputs from training dataset (as we have the expected result), and our predictions
    #print("Actual Predictions vs outputs")
    i = 0
    maxLength = len(predictions)
    while i < maxLength:
        # print("Ouput: ", y[i], "Prediction: ", predictions[i])
        i = i + 1

    # predict using classes (returns 1 or 0)
    roundedPredictions = model.predict_classes(testDataset, batch_size=1, verbose=0)

    # print outputs from training dataset (as we have the expected result), and our new rounded predictions
    # print("Rounded Predictions vs outputs")
    i = 0
    maxLength = len(predictions)
    wrong = 0
    right = 0
    falsePositives = 0
    while i < maxLength:
        # print("Ouput: ", y[i], "Prediction: ", int(roundedPredictions[i]))
        if y[i] == int(roundedPredictions[i]):
            right = right + 1
        else:
            wrong = wrong + 1
            if y[i] == 1 and y[i] != int(roundedPredictions[i]):
                falsePositives = falsePositives + 1
        i = i + 1

    # print how many we got right/wrong, and the overall accuracy of our predictions
    print("Right Predictions: ", right, "Wrong Predictions: ", wrong)
    ourAccuracy = (right*100)/maxLength
    print("Accuracy of our predictions is: ", ourAccuracy, "%")
    print("False Positives: ", falsePositives, " out of ", len(roundedPredictions), " predictions")
    endtime = time.time()
    timeTaken = int(endtime) - int(startTime)
    print("Model took " + str(timeTaken))
    overallFalsePositive.append(falsePositives)
    overallPercentages.append(ourAccuracy)
    counter = counter + 1
print(overallFalsePositive)
print(overallPercentages)
