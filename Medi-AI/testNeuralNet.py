from keras.models import Sequential
from keras.layers import Dense

dataPath = "diabetes-data"
# dataFileName = "data-"
#
# i = 1
# maxFiles = 70
# while i < maxFiles:
#    if len(str(i)) == 1:
#        tempFileName = (dataFileName+"0"+str(i))
#    else:
#        tempFileName =(dataFileName+str(i))
#    loadtxt(dataPath + "/" + tempFileName)
#    i = i + 1

# Get all data from file
dataFileName = "data-01"
lines = []
with open(dataPath + "/" + dataFileName, "r") as file:
    for line in file:
        lines.append(line)
codes = []
values = []
for line in lines:
    temp = line.split("	")
    codes.append(temp[2])
    values.append(temp[3].strip("\n"))

print(codes)
print(values)

# define the keras model
model = Sequential()
model.add(Dense(12, input_dim=8, activation='relu'))
model.add(Dense(8, activation='relu'))
model.add(Dense(1, activation='sigmoid'))

# compile the keras model
model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

# fit the keras model on the dataset
model.fit(codes, values, epochs=150, batch_size=10)

# evaluate the keras model
_, accuracy = model.evaluate(codes, values)
print('Accuracy: %.2f' % (accuracy*100))
