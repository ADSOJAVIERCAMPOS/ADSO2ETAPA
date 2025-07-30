package co.sena.edu.agora.controller;

import co.sena.edu.agora.business.PersonBusiness;
import co.sena.edu.agora.dto.PersonDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/persons")
public class PersonController {

    @Autowired
    private PersonBusiness personBusiness;

    @GetMapping("/all")
    public List<PersonDTO> getAllPersons() {
        return personBusiness.getAllPersons();
    }

    @PostMapping("/create")
    public PersonDTO createPerson(@RequestBody PersonDTO personDTO) {
        return personBusiness.createPerson(personDTO);
    }

    @PutMapping("/update/{id}")
    public PersonDTO updatePerson(@PathVariable Long id, @RequestBody PersonDTO personDTO) {
        return personBusiness.updatePerson(id, personDTO);
    }

    @PatchMapping("/state/{id}")
    public PersonDTO updatePersonState(@PathVariable Long id, @RequestBody Map<String, Boolean> stateRequest) {
        Boolean state = stateRequest.get("state");
        return personBusiness.updatePersonState(id, state);
    }
}
