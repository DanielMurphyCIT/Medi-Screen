## Breakdown of the Medi-AI  ##

### Datasets ###  
**Datasets** folder contains three datasets found from the UCI repository.  
And text files explaining the attributes.  

Each machine learning model once trained has been saved,  
The models are stored in two forms, json and h5.  
json is the model structure  and h5 is the model weights  

### Predictions ###  
**runModelsOnInsert.py** is a script that loads and runs predictions on our saved model.  
However this functionality is tied to updates from a database.  
It will check for any entry in the medicalHistory database table that has not been calculated.  
This is defined by a 1 or 0 in the beenCalculated column.  

Important content here is:  
  
`line 10 def loadModel(name):`  
As this function loads a model from json and h5 (our saving structure)  

`line 39 - 44:`
As this shows our prediction logic, there is some reliance on the database code so keep an eye out for that  

### Training ###  
**testNeuralNet.py** is a sample training and testing of a model using keras.  

**trainModelsOnInsert.py** this code allows our machine learning models to be re-trained.  
The updating of the models is tied to the database, once a row in the datasetUpdates table has the updated column set to 1, we re-train that model.  
Re-training and saving the model was implemented in the case of an admin user, adding entries to our datasets and extending our ML models.  

**trainOn X** these three .py files run ML training on their corresponding datasets.  
The code for training may be slightly different due to a different structure in the datasets.  
There is added accuracy saving at the end of the files, this is just uploading an accuracy value to our model in the database,  
Used as a way to show the users how accurate the results were.  


