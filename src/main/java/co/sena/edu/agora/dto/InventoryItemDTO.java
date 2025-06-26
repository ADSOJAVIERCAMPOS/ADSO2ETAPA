package co.sena.edu.agora.dto;

import lombok.Data;

@Data
public class InventoryItemDTO {
    private Long id;
    private String description;
    private String assetTag;
    private Boolean isAvailable;
}
