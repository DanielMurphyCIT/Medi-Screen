# Strip all outputs from the dataset, so we can use the full dataset as testing data
import os

# Initialize Variables
inputFileName = "pima-indians-diabetes.txt"
outputFileName = "pima-indians-diabetes-testFull.txt"
cwd = os.getcwd()
filePath = os.path.join(cwd, inputFileName)

# Check if the file required exists
if os.path.exists(filePath):
    lines = []

    # Open the file in read mode
    with open(filePath, "r") as file:
        # Cycle through each line, adding it to the list of lines
        for line in file:
            temp = line.split(",")
            lineString = ""
            i = 0
            while i < 8:
                if i == 7:
                    lineString = lineString + temp[i]
                else:
                    lineString = lineString + temp[i] + ","
                i = i + 1
            lines.append(lineString)

    outputFile = open(outputFileName, "w")
    for x in lines:
        # write each line to the file
        outputFile.write(x)
        outputFile.write("\n")
    outputFile.close()

# Error Message to print if the files required aren't present
else:
    print("Sorry you are missing files")
