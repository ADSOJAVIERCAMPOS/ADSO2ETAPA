package co.sena.edu.agora.service;

import co.sena.edu.agora.dto.PersonDTO;
import co.sena.edu.agora.entity.Person;
import co.sena.edu.agora.exception.DuplicateResourceException;
import co.sena.edu.agora.exception.ResourceNotFoundException;
import co.sena.edu.agora.repository.PersonRepository;
import org.modelmapper.ModelMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
public class PersonService {

    private final PersonRepository personRepository;
    private final ModelMapper modelMapper;

    @Autowired
    public PersonService(PersonRepository personRepository, ModelMapper modelMapper) {
        this.personRepository = personRepository;
        this.modelMapper = modelMapper;
    }

    public List<PersonDTO> getAllPersons() {
        return personRepository.findAll().stream()
                .map(person -> modelMapper.map(person, PersonDTO.class))
                .collect(Collectors.toList());
    }

    public PersonDTO createPerson(PersonDTO personDTO) {
        if (personRepository.existsByDocumentNumber(personDTO.getDocumentNumber())) {
            throw new DuplicateResourceException("Person with document number " + personDTO.getDocumentNumber() + " already exists.");
        }
        Person person = modelMapper.map(personDTO, Person.class);
        Person savedPerson = personRepository.save(person);
        return modelMapper.map(savedPerson, PersonDTO.class);
    }

    public PersonDTO updatePerson(Long id, PersonDTO personDTO) {
        Person existingPerson = personRepository.findById(id).orElseThrow(() -> new ResourceNotFoundException("Person with ID " + id + " not found."));
        modelMapper.typeMap(PersonDTO.class, Person.class).addMappings(mapper -> mapper.skip(Person::setId));
        modelMapper.map(personDTO, existingPerson);
        Person updatedPerson = personRepository.save(existingPerson);
        return modelMapper.map(updatedPerson, PersonDTO.class);
    }

    public PersonDTO updatePersonState(Long id, Boolean state) {
        Person existingPerson = personRepository.findById(id).orElseThrow(() -> new ResourceNotFoundException("Person with ID " + id + " not found."));
        existingPerson.setState(state);
        Person updatedPerson = personRepository.save(existingPerson);
        return modelMapper.map(updatedPerson, PersonDTO.class);
    }
}
