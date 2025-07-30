package co.sena.edu.agora.repository;

import co.sena.edu.agora.entity.Person;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface PersonRepository extends JpaRepository<Person, Long> {
    boolean existsByDocumentNumber(String documentNumber);
}
