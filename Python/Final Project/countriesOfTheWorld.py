import sys

from PyQt5.QtWidgets import QApplication, QMainWindow, QMessageBox
from PyQt5.QtGui import QPixmap
#ADD IMPORT STATEMENT FOR YOUR GENERATED UI.PY FILE HERE
import Ui_countriesOfTheWorld
#      ^^^^^^^^^^^ Change this!

#CHANGE THE SECOND PARAMETER (Ui_ChangeMe) TO MATCH YOUR GENERATED UI.PY FILE
class MyForm(QMainWindow, Ui_countriesOfTheWorld.Ui_MainWindow):
#                         ^^^^^^^^^^^   Change this!
    #declared 
    unsaved_changes = False#use this for checking if the user has changes but they arent saved to the file
    countriesList=[]#list that will contain the file 
    # DO NOT MODIFY THIS CODE
    def __init__(self, parent=None):
        super(MyForm, self).__init__(parent)
        self.setupUi(self)
        
    # END DO NOT MODIFY
        
        # ADD SLOTS HERE, indented to this level (ie. inside def __init__)
        self.actionSave.setEnabled(False)#automatticaly sets the save button disabled
        self.comboBoxArea.addItem("Sq. Miles ")#adds mils and km option to combobox 
        self.comboBoxArea.addItem("Sq. KM ")
        self.radioButtonPopulationMile.clicked.connect(self.densityMileClicked)#when the mile button is clicked i want it to change the label for area
        self.radioButtonPopulationKilo.clicked.connect(self.densityKMClicked)#when the km button is clicked i want it to change the label for area
        self.comboBoxArea.currentIndexChanged.connect(self.areaChanged)#i need to know when the combo and what index it is
        self.groupBoxCountriesInfo.setVisible(False)#at the start of the program it will not shows the right side 
        self.actionSave.triggered.connect(self.saveButtonClicked)#i want to know when either the action or save button are clicked
        self.actionExit.triggered.connect(self.exitProgram)
        self.actionLoadCountries.triggered.connect(self.loadingButtonClicked)#the first action the user will do is clicking the load countries option
        self.listWidgetAllCountries.currentRowChanged.connect(self.rowChanged)#whenever a user clicks on a new country 
        self.pushButtonUpdatePopulation.clicked.connect(self.updateClicked)#when the user clicks the update population button
        
        #a new slot that changes that when the update population button is clicked it saves it to memory not the file
    # ADD SLOT FUNCTIONS HERE
    # These are the functions your slots will point to
    # Indent to this level (ie. inside the class, at same level as def __init__)
    
    def loadingButtonClicked(self):
        self.loadData()#helper function that loads file into a list
        for row in self.countriesList:#for each line in the file
            self.listWidgetAllCountries.addItem(row[0])#add the country name to the list in the GUI list widget
        self.actionLoadCountries.setEnabled(False)#turns the Load Countries button off as it does not need to be used anymore
        

    def rowChanged(self, indexOfRow):#whenever a row is changed:
        self.groupBoxCountriesInfo.setVisible(True)# i the user to see the right side of the window now
        self.labelCountryName.setText(self.countriesList[indexOfRow][0])#sets the label near the top to show the name of the country
        self.lineEditPopulation.setText("{0:,}".format(int(self.countriesList[indexOfRow][1])))#sets the population to  amount in the list with commas
        self.labelArea.setText("{0:,.1f}".format(float(self.countriesList[indexOfRow][2])))#sets the area label to the amount in the list
        self.labelPercentageValue.setText("{0:.4f}%".format(self.countryPercentageOfWorld(indexOfRow)))#runs a function that calculates the percentage of the world population that the country has
        
        flagImage= QPixmap("Final Project\Basic_CountriesOfTheWorld\Flags\{0}".format(self.imageName(indexOfRow)))#grabs the location of the flag image using a function that converts the name of the country in the list to once that works for the format of the flags folder
        self.labelFlag.setPixmap(flagImage)#sets the image of the flag onto the label
        
        self.comboBoxArea.setCurrentIndex(0)#defaults the combo box to miles when switching between countries
        self.radioButtonPopulationMile.setChecked(True)#defaults the miles radiobutton to be clicked
        self.labelDensity.setText("{0:.2f}".format(self.popDenseMiles(indexOfRow)))#sets population density of current country

        
    
    def updateClicked(self):#when update population is clicked
        currentCountry=(self.listWidgetAllCountries.currentRow())#grabs the current index in the list widget
        populationText=(self.lineEditPopulation.text())#this variable is equal to the shown text
        populationText=(populationText.replace(",",""))#strips the population of variables so it can be used for math
        if str(populationText).isnumeric():#error handles if the user inputs something that isnt a number or comma

            self.countriesList[currentCountry][1]=(populationText)#updates the current value in memory that the user wants to change
        
            QMessageBox.information(self,
                                    'Updated',
                                    'Population has been updated in memory, but has not been updated in the file yet',
                                     QMessageBox.Ok)#displays a message box telling the user the population has been updated but not in the file just in memory in the list
            self.labelPercentageValue.setText("{0:.4f}%".format(self.countryPercentageOfWorld(currentCountry)))#all of these just update the labels and such that rely on the Population to a new value that reflects the change
            self.lineEditPopulation.setText("{0:,}".format(int(self.countriesList[currentCountry][1])))
            self.labelDensity.setText("{0:.2f}".format(self.popDenseMiles(currentCountry)))
            
            
            self.actionSave.setEnabled(True)#the user can now save to the file as they have made a change
            self.unsaved_changes=True#allows me to check if there is changes to the memory but not to the file
        else:#part of the error handling if the user entered an incorrect value itll display a message and set the value to the value they tried to change in memory
            self.lineEditPopulation.setText("{0:,}".format(int(self.countriesList[currentCountry][1])))
            QMessageBox.information(self,
                                   'Error',
                                    'Invalid Population Entered Please Try Again',
                                   QMessageBox.Ok )
        
    
    def areaChanged(self):#when the area combo box index is changed
        indexOfComboBox=self.comboBoxArea.currentIndex()#grabs the index of the combo box as a 0 or 1
        currentCountry=(self.listWidgetAllCountries.currentRow())#grabs the current country we are located in
        conversion=2.58999#conversion rate for miles to km
        miles=float(self.countriesList[currentCountry][2])#takes the miles from the list
        if indexOfComboBox==0:#if the current selected combobox item is Miles
            self.labelArea.setText("{0:,.1f}".format(miles))    #set the label to the miles squared
        elif indexOfComboBox==1:#if the current selected combobox item is Miles
            kilo=float(miles*conversion)#converts the defualt miles value to KM
            self.labelArea.setText("{0:,.1f}".format(kilo))   #sets the label to KM Squared
    
    def densityMileClicked(self):#if the desnity mile radiobutton is clicked
        currentCountry=self.listWidgetAllCountries.currentRow()#grabs the current row we are on
        self.labelDensity.setText("{0:,.2f}".format(self.popDenseMiles(currentCountry)))#uses popDense function to get the current population density and set it as the text
    
    def densityKMClicked(self):#if the density km radiobutton is clicked
        conversion=2.58999#conversion rate between miles and km
        currentCountry=self.listWidgetAllCountries.currentRow()#grabs current ro we are on
        population=float(self.countriesList[currentCountry][1])#grabs the population we have
        areaMile=float(self.countriesList[currentCountry][2])#grabs the area that in miles from the list
        areaKM=areaMile*conversion#converts the area into KM
        density=population/areaKM#calculates population density
        
        self.labelDensity.setText("{0:,.2f}".format(density))#sets the label to km density
    def exitProgram(self):#exits program
        QApplication.closeAllWindows()#shuts down all windows
        

    def saveButtonClicked(self):#when the save button is clicked
        self.saveToFile()#function that saves current list called countriesList into the file
        QMessageBox.information(self,
                                'Saved',
                                'Population has been updated in the file',
                                QMessageBox.Ok)#informs user the file has been updated
        self.unsaved_changes=False#since things were saved the unsaved changes are now false
        self.actionSave.setEnabled(False)#the save to file button is now disabled as there are no differences in the data
#Example Slot Function
#   def SaveButton_Clicked(self):
#       Make a call to the Save() helper function here
    
    
    #ADD HELPER FUNCTIONS HERE
    # These are the functions the slot functions will call, to 
    # contain the custom code that you'll write to make your progam work.
    # Indent to this level (ie. inside the class, at same level as def __init__)
    def loadData(self):#loads the data in the file to the list for use
        fileName="Final Project\Basic_CountriesOfTheWorld\countries.txt"
        accessMode="r"

        with open(fileName, accessMode) as csvFile:
            import csv
            rawList=csv.reader(csvFile)#puts the file into a list i calkl raw list as i cannot use it currently because it is not considered a full list
            self.countriesList=[]#declares variable
            for row in rawList:#puts each line in the raw list into a functioning list
                self.countriesList.append(row)
    
    def countryPercentageOfWorld(self,indexOfRow):#grabs the current countrys percentage of the world
        
        worldPopulation=[]
        for row in range(len(self.countriesList)):#makes a list of all population numbers
            worldPopulation.append(int(self.countriesList[row][1]))
        worldTotal=sum(worldPopulation)#adds the whole list together
        currentCountryPopulation=int(self.countriesList[indexOfRow][1])#grabs the population in memory for the current country
        currentCountryPercentage=(currentCountryPopulation/worldTotal)*100#turns the current country population into a percentage of the total population of the world
        return currentCountryPercentage
    
    def imageName(self,indexOfRow):#converts country name into the name of the png in the flags folder
        flagFile=self.countriesList[indexOfRow][0]#grabs the name of the country
        flagFile=flagFile.replace(" ","_")#replaces any spaces with underscores
        return flagFile#returns the new name
    
    def popDenseMiles(self,indexOfRow):#grabs the population density in miles format
        population=float(self.countriesList[indexOfRow][1])#grabs population of current country
        area=float(self.countriesList[indexOfRow][2])#grabs area in miles of current country
        density=population/area#calculate the density 
        return density#returns the density

    def saveToFile(self):#saves the changes to the file
        with open ("Final Project\Basic_CountriesOfTheWorld\countries.txt","w") as countriesFile:#opens the original file
            for row in self.countriesList:#rewrites the original file with our list in memory 
                countriesFile.write(",".join(row) + "\n")
    
    def closeEvent(self, event):#pop up window if the user hasnt saved their changes

        if self.unsaved_changes == True:#if there have been changes that have not been saved

            msg = "Save changes to file before closing?"#pops up a message that asks if the user wants to close the file without saving or do they want to save
            reply = QMessageBox.question(self, 'Save?',
                     msg, QMessageBox.Yes, QMessageBox.No)#gives the user 2  options yes or no

            if reply == QMessageBox.Yes:#if they click yes itll save the changes and close the windows
                self.saveToFile()
                event.accept()
            #end
#Example Helper Function
#    def Save(self):
#       Implement the save functionality here

# DO NOT MODIFY THIS CODE
if __name__ == "__main__":
    app = QApplication(sys.argv)
    the_form = MyForm()
    the_form.show()
    sys.exit(app.exec_())
# END DO NOT MODIFY