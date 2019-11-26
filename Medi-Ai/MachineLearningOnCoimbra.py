from numpy import loadtxt
from keras.models import Sequential
from keras.layers import Dense
import time

# Get start time
startTime = time.time()

# load the dataset
dataset = loadtxt('Datasets\\BreastCancerCoimbraDataSet.csv', delimiter=',')

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
model.fit(X, y, epochs=300, batch_size=3)

# evaluate the keras model
_, accuracy = model.evaluate(X, y)
print('Accuracy: %.2f' % (accuracy*100))