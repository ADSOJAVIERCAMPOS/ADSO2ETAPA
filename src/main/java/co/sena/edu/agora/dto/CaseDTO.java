package co.sena.edu.agora.dto;

import lombok.Data;

import java.time.LocalDateTime;
import java.util.UUID;

@Data
public class CaseDTO {
    private Long id;
    private UUID caseNumber;
    private ApprenticeDTO apprentice;
    private CaseCategoryDTO category;
    private UserDTO registeredBy;
    private LocalDateTime registeredAt;
    private String reason;
    private String observation;
    private String caseStatus;
    private String resolution;
}
