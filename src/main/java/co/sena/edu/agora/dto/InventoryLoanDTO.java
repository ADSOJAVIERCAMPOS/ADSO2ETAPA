package co.sena.edu.agora.dto;

import lombok.Data;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.UUID;

@Data
public class InventoryLoanDTO {
    private Long id;
    private UUID loanNumber;
    private ApprenticeDTO apprentice;
    private InventoryItemDTO item;
    private UserDTO registeredBy;
    private LocalDate loanDate;
    private LocalTime loanTime;
    private LocalDate returnDate;
    private LocalTime returnTime;
}
