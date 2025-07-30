package co.sena.edu.agora.entity;

import jakarta.persistence.*;
import lombok.Data;

@Data
@Entity
@Table(name = "relatives")
public class Relative {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "relative_id")
    private Long id;

    @ManyToOne
    @JoinColumn(name = "person_id", nullable = false)
    private Person person;
}
