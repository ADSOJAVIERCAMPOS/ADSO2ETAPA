package co.sena.edu.agora.dto;

import lombok.Data;

@Data
public class ApprenticeDTO {
    private Long id;
    private PersonDTO person;
    private String recordNumber;
    private String recordType;
}
