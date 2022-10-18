<?php

include '../data/instructorData.php';

class InstructorBusiness {

    public function InstructorBusiness() {
        $this->InstructorData = new InstructorData();
    }

    public function insertar($instructor) {
        return $this->InstructorData->insertInstructor($instructor);
    }

    public function update($instructor) {
        return $this->InstructorData->updateInstructor($instructor);
    }

    public function delete($id) {
        return $this->InstructorData->deleteInstructor($id);
    }

    public function obtener() {
        return $this->InstructorData->getInstructores();
    }

    public function buscar($palabra) {
        return $this->InstructorData->buscarInstructores($palabra);
    }

}
