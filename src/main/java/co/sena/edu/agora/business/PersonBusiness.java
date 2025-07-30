package co.sena.edu.agora.business;

import co.sena.edu.agora.dto.PersonDTO;
import co.sena.edu.agora.service.PersonService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import java.util.List;

@Component
public class PersonBusiness {

    @Autowired
    private PersonService personService;

    public List<PersonDTO> getAllPersons() {
        return personService.getAllPersons();
    }

    public PersonDTO createPerson(PersonDTO personDTO) {
        return personService.createPerson(personDTO);
    }

    public PersonDTO updatePerson(Long id, PersonDTO personDTO) {
        return personService.updatePerson(id, personDTO);
    }

    public PersonDTO updatePersonState(Long id, Boolean state) {
        return personService.updatePersonState(id, state);
    }
}
