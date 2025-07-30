package co.sena.edu.agora.dto;

import co.sena.edu.agora.enums.DocumentType;
import lombok.Data;

import java.time.LocalDate;

@Data
public class PersonDTO {
    private Long id;
    private String firstName;
    private String lastName;
    private DocumentType documentType;
    private String documentNumber;
    private String phone;
    private String email;
    private String address;
    private LocalDate birthDate;
    private Boolean state;
}
