package co.sena.edu.agora.dto;

import lombok.Data;

@Data
public class ExternalCaseDTO {
    private Long id;
    private CaseDTO caseEntity;
    private RelativeDTO relative;
    private String relativeContact;
    private String relativeObservation;
}
